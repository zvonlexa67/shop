<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacteristicsRequest extends FormRequest
{
  public function prepareForValidation()
  {

    // dump($this->all());

    $arrProductCharacteristicsPivot = [
      'id' => $this->id,
      'characteristics' => [],
    ];

    foreach($this->all()['characteristics'] as $gr){
      foreach($gr['children'] as $ch){
        // dump($ch['id']);
        // dump($ch['type']);
        // dump($ch['first']);
        // dump($ch['last']);

        if ($ch['first'] != null || $ch['last'] != null){
          // $arrProductCharacteristicsPivot['characteristics'][];

          switch ((int)$ch['type']) {
            case 1:
              $arrProductCharacteristicsPivot['characteristics'][(int)$ch['id']] = [
                'value' => [
                  'type' => 1,
                  'first' => $ch['first'],
                ],
              ];
              break;
            case 2:
              break;
            case 3:
              $arrProductCharacteristicsPivot['characteristics'][(int)$ch['id']] = [
                'value' => [
                  'type' => 3,
                  'first' => $ch['first'],
                ],
              ];
              break;
            case 4:
              break;
            case 5:
              break;
            case 8:
              $arrProductCharacteristicsPivot['characteristics'][(int)$ch['id']] = [
                'value' => [
                  'type' => 8,
                  'first' => $ch['first']['value'],
                ],
              ];
              break;
            default:
              break;
          }
        }
      }
    }

    // dump($arrProductCharacteristicsPivot);

    // dd('code');


        // $arrAll = $this->all();
        // $arrChar = [];

        // // dd($arrAll);

        // foreach($arrAll['char'] as $pr){
        //     $arrChar = array_merge($arrChar, $pr['char']);
        // }

        // $valueCategoryCharacteristicProduct = [];

        // foreach($arrChar as $char) {
        //     $valueCategoryCharacteristicProduct[] = [
        //         'category_product_id' => $arrAll['product_pivot_id'],
        //         'category_characteristic_id' => $char['pivot_id'],
        //         'type' => $char['type'],
        //         'first' => is_null($char['first']) ? null : (is_array($char['first']) ? $char['first'] : [ 'value' => $char['first'] ]),
        //         'last' => is_null($char['last']) ? null : (is_array($char['last']) ? $char['last'] : [ 'value' => $char['last'] ]),
        //     ];
        // }

      $this->replace($arrProductCharacteristicsPivot);
      // $this->replace([
      //   'value' => $arrProductCharacteristicsPivot,
      // ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer' ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Отсутствует id',
        ];
    }
}
