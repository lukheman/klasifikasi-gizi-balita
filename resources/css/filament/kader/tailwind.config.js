import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Kader/**/*.php',
        './resources/views/filament/kader/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
