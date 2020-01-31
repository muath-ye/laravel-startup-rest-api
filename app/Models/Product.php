<?php
/**
 * Product Model
 * PHP version 7.1
 * 
 * @category Models
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Product Model
 * PHP version 7.1
 * 
 * @category Models
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details'
    ];
}
