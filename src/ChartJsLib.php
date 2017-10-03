<?php 
namespace YusrilHs\ChartJsHelper;

use YusrilHs\ChartJsHelper\ChartJsDataset;
use InvalidArgumentException;

class ChartJsLib {

    /**
     * Chart.js labels
     * @var array
     */
    protected $labels = array();

    /**
     * Type of chart
     * @var string
     */
    protected $chartType = '';

    /**
     * Chart.js options
     * @var array
     */
    protected $options = array();

    /**
     * Fill zero
     * @var array
     */
    protected $fillZero = false;

    /**
     * Rainbow color
     * @var boolean
     */
    protected $rainbowColor = false;

    /**
     * Datasets of chart
     * @var array
     */
    protected $datasets = array();

    /**
     * COnstructor
     * @param string $type 
     */
    public function __construct($type) {
        $this->chartType = $type;
    }

    /**
     * Set labels of Chart
     * @param array $labels 
     */
    public function setLabels($labels) {
        if (isArrayAssoc($labels)) {
            throw new InvalidArgumentException('Argument must not array associative');
        }

        $this->labels = $labels;
    }

    /**
     * Retrieve labels of Chart
     * @return array        
     */
    public function getLabels() {
        return $this->labels;
    }

    /**
     * Set options of chart
     * @param array $opts
     */
    public function setOptions($opts) {
        $this->options = $opts;
    }

    /**
     * Retrieve options of chart
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Fill zero to initializing data on datasets
     * @return void
     */
    public function useFillZero() {
        $this->fillZero = true;
    }

    /**
     * Check is data must fill with zero value
     * @return boolean 
     */
    public function usingFillZero() {
        return $this->fillZero;
    }

    /**
     * Use rainbow color for backgoundColor & borderColor
     * on datasets
     * @return void
     */
    public function useRainbowColor() {
        $this->rainbowColor = true;
    }

    /**
     * Check is chart using rainbowColor
     * @return boolean
     */
    public function usingRainbowColor() {
        return $this->rainbowColor;
    }

    /**
     * Create dataset
     * @param string $id
     * @param string $label 
     */
    public function createDataset($id, $label) {
        if ($this->hasDataset($id)) {
            throw new InvalidArgumentException(sprintf('Dataset %s is already defined', $id));
        }

        $dataset = new ChartJsDataset($label);
        $this->datasets[$id] = $dataset;

        if ($this->usingFillZero()) {
            $dataset->setData(array_fill(0, count($this->labels), 0));
        }

        return $dataset;
    }

    /**
     * Retrieve dataset by id
     * @param  string $id [description]
     * @return YusrilHs\ChartJsHelper\ChartJsDataset
     */
    public function dataset($id) {
        if (!$this->hasDataset($id)) {
            throw new InvalidArgumentException(sprintf('Dataset %s is not defined', $id));
        }

        return $this->datasets[$id];
    }

    /**
     * Check dataset is defined
     * @param  string  $id 
     * @return boolean     
     */
    public function hasDataset($id) {
        return isset($this->datasets[$id]);
    }

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {

    }

}
