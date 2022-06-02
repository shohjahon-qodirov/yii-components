<?php

namespace common\components;

use yii\base\Component;
use yii\httpclient\Client;

class ShortLink extends Component {

    public $baseUrl = 'https://goo.su/';

    public function Generation($url) {
        $client = new Client(['baseUrl' => $this->baseUrl]);
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('POST')
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setUrl('api/convert')
            ->setData([
                'token' => 'HYDYeRztWGMA4oeynm5r2UPmzdVm3Sz4avvWqLaBSmWcpo15sEYPo3K0v93l',
                'url' => $url,
                'is_public' => true
            ])
            ->send();
        if ($response->isOk) {
            $result = $response;
        }
        else
        {
            $result = $response;
        }

        return $result->data['short_url'];
    }

}
