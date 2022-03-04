<?php namespace Eugene3993\Sitemap;

use System\Classes\PluginBase;
use System\Classes\PluginManager;
use Cms\Classes\Theme;
use Lang;

class Plugin extends PluginBase {

    public function register() {
        \Event::listen('backend.form.extendFields', function($widget) {

            if ($widget->isNested === false ) {

                if (!($theme = Theme::getEditTheme()))
                    throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));

                if (PluginManager::instance()->hasPlugin('RainLab.Pages') && $widget->model instanceof \RainLab\Pages\Classes\Page) {
                    $widget->addFields( array_except($this->staticSeoFields(), ['viewBag[model_class]']), 'primary');
                }

                if (!$widget->model instanceof \Cms\Classes\Page) return;

                $widget->addFields($this->cmsSeoFields(), 'primary');
            }

        });
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
                ] : [],
            )
        );
    }
}
