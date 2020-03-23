<?php
declare(strict_types=1);

if (!\function_exists('config_path')) {
    /** @noinspection PhpFunctionNamingConventionInspection Inherited from Laravel */
    /**
     * Returns configuration path.
     *
     * @param null|string $path
     *
     * @return string
     */
    function config_path(?string $path = null) {
        return \base_path($path ?? '');
    }
}
