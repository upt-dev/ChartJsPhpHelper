<?php 
namespace YusrilHs\ChartJsHelper;

use InvalidArgumentException;

class ChartDataset {

    /**
     * Label of dataset
     * @var string
     */
    protected $label = '';

    /**
     * Dataset properties
     * @var array
     */
    protected $properties = array(); 

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
        if ($value == 'data' || $value == 'label') {
            throw new InvalidArgumentException(sprintf('You couldn\'t using %s on setProperty', $key));
        }

        $this->properties[$key] = $value;
        return $this;
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

        return $this;
    }
}
