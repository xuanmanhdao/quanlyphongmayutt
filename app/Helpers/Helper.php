<?php
if (!function_exists('kiemTraAdmin')) {
    function kiemTraAdmin()
    {
        return session()->get('Quyen') === 0;
    }
}
