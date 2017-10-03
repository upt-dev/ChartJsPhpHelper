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
     * Set property of datasets
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
     * Retrieve properties of dataset
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * Retrieve label of dataset
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set data of datasets
     * @param number            $index 
     * @param boolean|number    $value 
     */
    public function setData($index, $value = false) {
        if ($value !== false && count($this->data) === 0) {
            throw new InvalidArgumentException('You must use zeroFill if setData using index');
        }

        // Set all data
        if ($value === false) $this->data = $index;
        // Set data on index
        else $this->data[$index] = $value;
    }

    /**
     * Get data on dataset
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}
