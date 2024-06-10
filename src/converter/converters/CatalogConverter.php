<?php

include_once 'src/converter/ConverterInterface.php';
include_once 'src/logger/Logger.php';
include_once 'src/console/Console.php';

class CatalogConverter implements ConverterInterface
{
    public function convert(string $source): Table|false
    {
        if (file_exists($source) === false || is_file($source) === false){
            Logger::logError('File could not be found: ' . $source);
            return false;
        }

        $catalog = simplexml_load_file($source);
        if($catalog === false){
            Logger::logError('Failed to parse XML: ' . $source);
        }

        foreach ($catalog as $item){
            $mapped = $this->tableMapper($item);
            foreach ($mapped as $field => $value){
                Console::output($field .': ' . $value);
            }
            break;
        }

        return new Table();
    }

    public function tableMapper(SimpleXMLElement $item): array{
        return [
            'entity_id' => $item->entity_id,
            'category_name' => $item->CategoryName,
            'sku' => $item->sku,
            'name' => $item->name,
            'short_description' => $item->shortdesc,
            'description' => $item->description,
            'price' => $item->price,
            'link' => $item->link,
            'image' => $item->image,
            'brand' => $item->Brand,
            'rating' => $item->Rating,
            'caffeine_type' => $item->CaffeineType,
            'count' => $item->Count,
            'flavored' => $item->Flavored,
            'seasonal' => $item->Seasonal,
            'instock' => $item->Instock,
            'facebook' => $item->Facebook,
            'is_k_cup' => $item->IsKCup,
        ];
    }
}