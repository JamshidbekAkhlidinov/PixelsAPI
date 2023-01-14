<?php

namespace jamshidbekakhlidinov;

class PixelsAPI
{

    public $size = 'medium';
    public $color = null;
    public $locale = 'en-US';
    public $page = 1;
    public $per_page = 15; //max 80;


    /** locale search text
     * 'pt-BR' 'es-ES' 'ca-ES' 'de-DE' 'it-IT' 'fr-FR' 'sv-SE' 'id-ID'
     * 'pl-PL' 'ja-JP' 'zh-TW' 'zh-CN' 'ko-KR' 'th-TH' 'nl-NL' 'hu-HU'
     * 'vi-VN' 'cs-CZ' 'da-DK' 'fi-FI' 'uk-UA' 'el-GR' 'ro-RO' 'nb-NO'
     * 'sk-SK' 'tr-TR' 'ru-RU'.
     */

    public function search($word, $options = [])
    {
        $array_merge = array_merge(['query' => $word], $options);
        return $this->request('search', $array_merge);
    }

    protected function getOptions()
    {
        return [
            'size' => $this->size,
            'color' => $this->color,
            'locale' => $this->locale,
            'page' => $this->page,
            'per_page' => $this->per_page,
        ];
    }

    public function request($request, $options = [])
    {
        $options = array_merge($options, $this->getOptions());
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.pexels.com/v1/' . $request . '?' . http_build_query($options));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = [];
        $headers[] = 'Authorization: 563492ad6f91700001000001c9f8e2939d1f4e80b3ba4f563c85722e';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

?>