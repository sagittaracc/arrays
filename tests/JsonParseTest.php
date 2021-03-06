<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use sagittaracc\ArrayHelper;

final class JsonParseTest extends TestCase
{
    public function testJsonParse(): void
    {
        $json = <<<JSON
{
  "id": 3587017605913182000,
  "ofdId": "ofd6",
  "receiveDate": "2021-02-20T06:35:09Z",
  "subtype": "receipt",
  "address": "692042,РОССИЯ,Приморский край, ,Лесозаводск г г.п., , ,Будника ул элем. улично-дорожн.сети,,д. 130 А, , , , ",
  "content": {
    "messageFiscalSign": 9297164016784290000,
    "code": 3,
    "fiscalDriveNumber": "9282440300530914",
    "kktRegId": "0001661268024418    ",
    "userInn": "2721218215  ",
    "fiscalDocumentNumber": 28903,
    "dateTime": 1613838840,
    "fiscalSign": 3785202167,
    "shiftNumber": 215,
    "requestNumber": 207,
    "operationType": 1,
    "totalSum": 190275,
    "operator": "Волохотюк Ольга",
    "items": [
      {
        "name": "Пакет майка белый большой ПНД 35 мкм",
        "price": 799,
        "quantity": 1,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 799
      },
      {
        "name": "Вафли КОРОВКА с шоколадной начинкой 300 гр",
        "price": 9499,
        "quantity": 2,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 18998
      },
      {
        "name": "Сухари Агеевские ванильные ЛЮКС 500 гр",
        "price": 12899,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 12899
      },
      {
        "name": "Масса творожная с курагой 4,5% 200 гр флоу-пак Серышевский БЗМЖ",
        "price": 8999,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 8999
      },
      {
        "name": "Рулетики СЛОЕНЫЕ С ДЖЕМОМ 300 гр",
        "price": 8999,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 8999
      },
      {
        "name": "Хлеб ДАРНИЦА 600 гр Колобок",
        "price": 4099,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 4099
      },
      {
        "name": "Салфетки влажные детские АУРА УЛЬТРА КОМФОРТ 60 шт",
        "price": 5999,
        "quantity": 1,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 5999
      },
      {
        "name": "Бумага туалетная 4 шт ПАПИЯ Секрет сада 3 слоя",
        "price": 11299,
        "quantity": 1,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 11299
      },
      {
        "name": "Картофель 1 кг Россия",
        "price": 4999,
        "quantity": 1.96,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 9798
      },
      {
        "name": "<А> Позы по-домашнему 800 гр Доброе Дело",
        "price": 28999,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 28999
      },
      {
        "name": "Батон НАРЕЗНОЙ 350 гр Колобок",
        "price": 3499,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 3499
      },
      {
        "name": "Пельмени ДОМАШНИЕ СЕКРЕТЫ 950 г Сибирский гурман 1/6",
        "price": 33799,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 33799
      },
      {
        "name": "Картофель 1 кг Россия",
        "price": 4999,
        "quantity": 2.224,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 11118
      },
      {
        "name": "Дрожжи хлебопекарные РЕЛИШ быстродействующие 100 гр",
        "price": 3289,
        "quantity": 1,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 3289
      },
      {
        "name": "ПРД Масло подсолнечное СКАЗКА 0,9 л 1/15",
        "price": 10590,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 10590
      },
      {
        "name": "Кетчуп ОТТОГИ томатный 300 гр 1/30",
        "price": 8898,
        "quantity": 1,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 8898
      },
      {
        "name": "Дрожжи хлебопекарные РЕЛИШ быстродействующие 10 гр",
        "price": 799,
        "quantity": 5,
        "nds": 1,
        "productType": 1,
        "paymentType": 4,
        "sum": 3995
      },
      {
        "name": "Чиабата 350 гр Колобок",
        "price": 4199,
        "quantity": 1,
        "nds": 2,
        "productType": 1,
        "paymentType": 4,
        "sum": 4199
      }
    ],
    "nds18": 8879,
    "nds10": 12456,
    "user": "ООО \"РозТех 25\"",
    "retailPlaceAddress": "692042 Приморский край, г. Лесозаводск ул. Будника, 130А; ОП КПП 25",
    "retailPlace": "Магазин \"Амбар\"",
    "appliedTaxationType": 1,
    "cashTotalSum": 0,
    "ecashTotalSum": 190275,
    "prepaidSum": 0,
    "creditSum": 0,
    "provisionSum": 0,
    "fiscalDocumentFormatVer": 2,
    "fnsUrl": "www.nalog.ru",
    "sellerAddress": "ofd@kontur.ru",
    "redefine_mask": 0
  }
}
JSON;

        $this->assertEquals([
            's1' => [
                'id' => 'integer',
                'ofdId' => 'string',
                'receiveDate' => 'string',
                'subtype' => 'string',
                'address' => 'string',
            ],
            's2' => [
                'messageFiscalSign' => 'double',
                'code' => 'integer',
                'fiscalDriveNumber' => 'string',
                'kktRegId' => 'string',
                'userInn' => 'string',
                'fiscalDocumentNumber' => 'integer',
                'dateTime' => 'integer',
                'fiscalSign' => 'integer',
                'shiftNumber' => 'integer',
                'requestNumber' => 'integer',
                'operationType' => 'integer',
                'totalSum' => 'integer',
                'operator' => 'string',
            ],
            's3' => [
                'name' => 'string',
                'price' => 'integer',
                'quantity' => 'integer',
                'nds' => 'integer',
                'productType' => 'integer',
                'paymentType' => 'integer',
                'sum' => 'integer',
            ],
        ], ArrayHelper::jsonStructure($json, ['s1', 's2', 's3']));
    }
}