<?php


function format_number($number): string
{
    return number_format((float)$number, 0, '.', '');
}
