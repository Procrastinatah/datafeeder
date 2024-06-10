<?php

include_once 'src/converter/ConverterInterface.php';
include_once 'src/converter/DatabaseConverter.php';
include_once 'src/logger/Logger.php';
include_once 'src/console/Console.php';

class CatalogConverter implements ConverterInterface
{
    public function convert(string $source): bool
    {
        if (file_exists($source) === false || is_file($source) === false){
            Logger::logError('File could not be found: ' . $source);
            return false;
        }

        $catalog = simplexml_load_file($source);
        if($catalog === false){
            Logger::logError('Failed to parse XML: ' . $source);
        }

        $databaseConverter = new DatabaseConverter();
        Console::output('inserting/editing data');
        foreach ($catalog as $item){
            $mappedItem = $this->mapItem($item);
            if($databaseConverter->convertData('catalog', 'entity_id', $mappedItem) === false){
                return false;
            }
        }
        return true;
    }

    public function mapItem(SimpleXMLElement $item): array {
        return [
            'entity_id' => $item->entity_id,
            'category_name' => $item->CategoryName,
            'sku' => $item->sku,
            'name' => $item->name,
            'short_description' => $item->shortdesc,
            'description' => $item->description,
            'price' => (float)$item->price,
            'link' => $item->link,
            'image' => $item->image,
            'brand' => $item->Brand,
            'rating' => (int)$item->Rating,
            'caffeine_type' => $item->CaffeineType,
            'count' => (int)$item->Count,
            'flavored' => $item->Flavored,
            'seasonal' => $item->Seasonal,
            'in_stock' => $item->Instock,
            'facebook' => $item->Facebook,
            'is_k_cup' => $item->IsKCup,
        ];
    }
}