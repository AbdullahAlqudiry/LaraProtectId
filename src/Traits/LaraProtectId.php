<?php 

namespace Alqudiry\LaraProtectId\Traits;
use Alqudiry\LaraProtectId\LuhnAlgorithm;

trait LaraProtectId {

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $value = $field ?? LuhnAlgorithm::originalId($value);
        return parent::where($field ?? parent::getRouteKeyName(), $value)->first();
	}

    /**
     * Get the calculated id by luhn
     *
     * @param  string  $value
     * @return string
     */
    public function getIdAttribute($id)
    {
        return LuhnAlgorithm::calculateId($id);
    }

    /**
     * Get the original id from luhn
     *
     * @param  string  $value
     * @return string
     */
    public function getOrgIdAttribute()
    {
        return LuhnAlgorithm::originalId($this->id);
    }

    /**
     * Override the default find method
     */
    public static function protectFind($id, $columns = ['*'])
    {
        $id = LuhnAlgorithm::originalId($id);
        return parent::find($id, $columns);
    }

    /**
     * Override the default findMany method
     */
    public static function protectFindMany($ids, $columns = ['*'])
    {
        $ids = LuhnAlgorithm::originalId($ids);
        return parent::findMany($ids, $columns);
    }

    /**
     * Override the default findOrFail method
     */
    public static function protectFindOrFail($id, $columns = ['*'])
    {
        $id = LuhnAlgorithm::originalId($id);
        return parent::findOrFail($id, $columns);
    }

    /**
     * Override the default findOrNew method
     */
    public static function protectFindOrNew($id, $columns = ['*'])
    {
        $id = LuhnAlgorithm::originalId($id);
        return parent::findOrNew($id, $columns);
    }
    

}