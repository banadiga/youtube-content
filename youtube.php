<?php

defined('_JEXEC') or die;

class PlgContentYoutube extends JPlugin {

    const IMG_ID = "system-youtube";

    protected $autoloadLanguage = true;

    function PlgContentYoutube( &$subject, $params ) {
        parent::__construct( $subject, $params );
    }

    function onContentPrepare( $context, &$article, &$params, $page = 0) {
        if ( JString::strpos( $article->text, self::IMG_ID ) === false ) {
            return true;
        }

        $article->text = preg_replace('/<img id="' . self::IMG_ID . '" src=\"http:\/\/i1.ytimg.com\/vi\/(.*)\/sddefault\.jpg\"(.*)\/>/', $this->embedVideo("$1"), $article->text);
        return true;

    }

    function embedVideo($vCode) {
        $type = $this->params->get('type', 1);

        switch ($type) {
            case 0:
                $width = 560;
                $height = 315;
                break;

            case 1:
                $width = 640;
                $height = 360;
                break;

            case 2:
                $width = 853;
                $height = 480;
                break;

            case 3:
                $width = 1280;
                $height = 720;
                break;

        };
        return '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $vCode . '" frameborder="0" allowfullscreen></iframe>';
    }

}
