<?php
namespace MshMsh\Actions;

trait DefaultMediaImage{

    public static $defaultImage = '/placeholders/user.png';
    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getMedia($collectionName)->last();
        return @$url ? @$url->getUrl() : url($this::$defaultImage) ?? '';
    }
}
