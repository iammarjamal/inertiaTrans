<?php

namespace Iammarjamal\InertiaTrans;

use Iammarjamal\InertiaTrans\Commands\InertiaTransCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use SplFileInfo;

class InertiaTransServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('inertiatrans')
            ->hasCommand(InertiaTransCommand::class);
    }

    public function packageBooted(): void
    {
        Blade::directive('inertiaTrans', function () {
            return "<?php echo \Iammarjamal\InertiaTrans\InertiaTransServiceProvider::renderTranslations(); ?>";
        });
    }

    public static function renderTranslations(): string
    {
        $locale = app()->getLocale();
        $translations = static::getTranslations($locale);

        $json = json_encode($translations, JSON_UNESCAPED_UNICODE);

        return "<script>window._translations = {$json};</script>";
    }

    protected static function loadTranslations(string $locale): array
    {
        $path = base_path("lang/{$locale}");

        $phpTranslations = File::exists($path)
            ? collect(File::allFiles($path))
            ->filter(fn(SplFileInfo $file) => $file->getExtension() === 'php')
            ->flatMap(function (SplFileInfo $file) {
                $filename = $file->getFilenameWithoutExtension();

                $translations = require $file->getRealPath();

                return Arr::dot([
                    $filename => $translations,
                ]);
            })
            ->toArray()
            : [];

        $jsonFile = base_path("lang/{$locale}.json");
        $jsonTranslations = File::exists($jsonFile)
            ? json_decode(File::get($jsonFile), true)
            : [];

        return array_merge($jsonTranslations, $phpTranslations);
    }


    public static function getTranslations(string $locale): array
    {
        if (app()->environment('production')) {
            return Cache::rememberForever(
                "inertiatrans_{$locale}",
                fn() => static::loadTranslations($locale)
            );
        }

        return static::loadTranslations($locale);
    }
}
