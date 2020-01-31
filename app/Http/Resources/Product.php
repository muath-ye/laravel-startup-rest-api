<?php
/**
 * Product Resource
 * PHP version 7.1
 * 
 * @category Resource
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Product Resource
 * PHP version 7.1
 * 
 * @category Resource
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request 
     * 
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
