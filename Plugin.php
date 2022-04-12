<?php namespace Eugene3993\Sitemap;

use System\Classes\PluginBase;
use System\Classes\PluginManager;

class Plugin extends PluginBase {
	
	public function register() {
		\Event::listen('cms.template.extendTemplateSettingsFields', function($extension,$dataHolder) {
			foreach($this->seoFieldsNew() as $item) {
				$dataHolder->settings[] = $item;
			}
			
		});
		\Event::listen('backend.form.extendFields', function($widget) {
			
			if ($widget->isNested === false ) {
				
				if (PluginManager::instance()->hasPlugin('RainLab.Pages') && $widget->model instanceof \RainLab\Pages\Classes\Page) {
					$widget->addFields( array_except($this->staticSeoFields(), ['viewBag[model_class]']), 'primary');
				}
				
				if (PluginManager::instance()->hasPlugin('RainLab.Blog') && $widget->model instanceof \RainLab\Blog\Models\Post) {
					$widget->addFields(array_except($this->blogSeoFields(), [
						'metadata[model_class]',
						'metadata[changefreq]',
						'metadata[priority]',
					]), 'secondary');
				}
				
				if (!$widget->model instanceof \Cms\Classes\Page) return;
				
				$widget->addFields($this->cmsSeoFields(), 'primary');
				
			}
			
		});
	}
	
	private function blogSeoFields() {
		return collect($this->seoFields())->mapWithKeys(function($item, $key) {
			return ["metadata[$key]" => $item];
		})->toArray();
	}
	
	private function staticSeoFields() {
		return collect($this->seoFields())->mapWithKeys(function($item, $key) {
			return ["viewBag[$key]" => $item];
		})->toArray();
	}
	
	private function cmsSeoFields() {
		return collect($this->seofields())->mapWithKeys(function($item, $key) {
			return ["settings[$key]" => $item];
		})->toArray();
	}
	
	private function seoFields() {
		$user = \BackendAuth::getUser();
		return array_except(
			\Yaml::parseFile(plugins_path('eugene3993/sitemap/config/seofields.yaml')),
			array_merge(
				[],
				!$user->hasPermission(["eugene3993.sitemap"]) ? [
					"use_in_sitemap",
					"model_class",
					"changefreq",
					"priority",
				] : []
			)
		);
	}
	
	private function seoFieldsNew() {
		$user = \BackendAuth::getUser();
		return array_except(
			\Yaml::parseFile(plugins_path('eugene3993/sitemap/config/seofieldsNew.yaml')),
			array_merge(
				[],
				!$user->hasPermission(["eugene3993.sitemap"]) ? [
					"use_in_sitemap",
					"model_class",
					"changefreq",
					"priority",
				] : []
			)
		);
	}
}
