<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

function isRouteActive($route)
{
    return request()->route()->getName() === $route;
}

function month($index)
{
    $indoMonthNames = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    return $indoMonthNames[$index - 1];
}

function format_dfy($date)
{
    $carbon = Carbon::parse($date);
    return $carbon->format('j') . ' ' . month($carbon->month) . ' ' . $carbon->format('Y');
}

function format_dfh($timestamp)
{
    $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);

    $formattedDate = $carbon->format('j') . ' ' . month($carbon->month) . ' ' . $carbon->format('y');

    return $formattedDate;
}

function format_time($timestamp)
{
    $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);
    $formattedTime = $carbon->format('H:i');

    return $formattedTime;
}

function formatRupiah($amount)
{
    return str_replace(':amount', number_format($amount), trans('currency.money'));
}

function formatRibuan($angka)
{
    return number_format($angka);
}

function isDosen()
{
    $role = auth()->user()->role;
    return $role == 'dosen';
}

function isMahasiswa()
{
    $role = auth()->user()->role;
    return $role == 'mahasiswa';
}

function limitCharacters($words, $limit)
{
    return strlen($words) > $limit ? substr($words, 0, $limit) . '...' : $words;
}

function isLimit($words, $limit)
{
    return strlen($words) > $limit;
}


function isFileExists($path, $default)
{
    $file = file_exists($path);

    if ($file) {
        return asset($path);
    } else {
        return $default;
    }
}

function checkNumber($number)
{
    if (substr($number, 0, 1) === '0') {
        return "+62" . ltrim($number, '0');
    } else {
        return $number;
    }
}

function removeComma($data)
{
    return doubleval(str_replace(',', '', $data));
}

function parseToPercentage($value, $max)
{
    return $value === 0 ? 0 : $value / $max * 100;
}

function getDomainOnly($url)
{
    $parsedUrl = parse_url($url);

    if (isset($parsedUrl['host'])) {
        return $parsedUrl['host'];
    }

    return '';
}

function deleteFile($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}

function generateFileName($originalName)
{
    return time() . '-' . str_replace(' ', '-', $originalName);
}

function removeProposalWord($string)
{
    return Str::replace('proposal', '', strtolower($string));
}

function validatorError($errors)
{
    $errorMessage = "";

    foreach ($errors as $value) {
        $errorMessage .= $value . "\n";
    }

    return $errorMessage;
}
