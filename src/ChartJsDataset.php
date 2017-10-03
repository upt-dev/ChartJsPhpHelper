<?php 
namespace YusrilHs\ChartJsHelper;

use InvalidArgumentException;

class ChartJsDataset {

    /**
     * Label of dataset
     * @var string
     */
    protected $label = '';

    /**
     * Dataset properties
     * @var array
     */
    public $properties = array(); 

    /**
     * Data of dataset
     * @var array
     */
    protected $data = array();

    /**
     * Constructor
     * @param string $label
     */
    public function __construct($label) {
        $this->label = $label;
    }

    /**
     * Set property on datasets
     * @param string $key   
     * @param string $value 
     */
    public function setProperty($key, $value) {
        if ($key == 'data' || $key == 'label') {
            throw new InvalidArgumentException(sprintf('Couldn\'t using %s on setProperty', $key));
        }

        $this->properties[$key] = $value;
    }

    /**
     * Set properties
     * @param array $properties
     */
    public function setProperties($properties) {
        if (!isArrayAssoc($properties)) {
            throw new InvalidArgumentException('Argument must be an array associative');
        }

        if (isset($properties['data']) || isset($properties['label'])) {
            throw new InvalidArgumentException('Couldn\'t set property label or data on setProperties');
        }

        $this->properties = $properties;
    }

    /**
     * Retrieve properties on dataset
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * Retrieve label on dataset
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set data on dataset
     * @param number|array      $index 
     * @param boolean|any       $value 
     */
    public function setData($index, $value = false) {
        if ($value !== false) {
            if (!isset($this->data[$index])) {
                throw new InvalidArgumentException(sprintf('Data with index %d is not defined', $index));
            }
        }

        // Set all data
        if ($value === false) $this->data = $index;
        // Set data on index
        else $this->data[$index] = $value;
    }

    /**
     * Append data on datasets
     * @param  any    $value 
     * @return void        
     */
    public function appendData($value) {
        array_push($this->data, $value);
    }

    /**
     * Get data on dataset
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}
