<?php 
namespace YusrilHs\ChartJsHelper;

use YusrilHs\ChartJsHelper\ChartJsDataset;
use InvalidArgumentException;

class ChartJsLib {
    /**
     * HTMLElement ID
     * @var string
     */
    protected $elementId = 'canvas';

    /**
     * Chart.js labels
     * @var array
     */
    protected $labels = array();

    /**
     * Type of chart
     * @var string
     */
    private $chartType = '';

    /**
     * Chart.js options
     * @var array
     */
    protected $options = array();

    /**
     * Fill zero
     * @var array
     */
    protected $useFillZero = false;

    /**
     * Rainbow color
     * @var boolean
     */
    protected $useRainbowColor = false;

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
     * Set options of chart
     * @param array $opts
     */
    public function setOptions($opts) {
        $this->options = $opts;
    }

    /**
     * Fill zero to initializing data on datasets
     * @return void
     */
    public function useFillZero() {
        $this->useFillZero = true;
    }

    /**
     * Use rainbow color for backgoundColor & borderColor
     * on datasets
     * @return void
     */
    public function useRainbowColor() {
        $this->useRainbowColor = true;
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

        if ($this->useFillZero) {
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
    public function getConfig() {
        $config = array(
            'type' => $this->chartType,
            'data'=> array(
                'datasets'=> array()
            )
        );

        if (!empty($this->labels)) {
            $config['data']['labels'] = $this->labels;
        }

        // Index if that using rainbowColor
        $index = 1;

        foreach ($this->datasets as $dataset) {
            $chartDataset = $dataset->getProperties();
            $chartDataset['data'] = $dataset->getData();
            
            if (strlen($dataset->getLabel()) > 0) {
                $chartDataset['label'] = $dataset->getLabel();
            }

            
            if ($this->useRainbowColor) {
                if (in_array($this->chartType, array('doughnut', 'pie', 'polarArea'))) {
                    $chartDataset['backgroundColor'] = array();
                    foreach ($chartDataset['data'] as $key => $value) {
                        array_push($chartDataset['backgroundColor'], $this->getCalcRainbow(count($chartDataset['data']), $index));
                        $index++;
                    }
                    // Initialize index again for next dataset
                    $index = 1;
                } else {
                    $color = $this->getCalcRainbow(count($this->datasets), $index);
                    $chartDataset['backgroundColor'] = $color;
                    $chartDataset['borderColor'] = $color;
                    $index++;
                }
            }

            array_push($config['data']['datasets'], $chartDataset);
        }

        if (!empty($this->options)) {
            $config['options'] = $this->options;
        }

        return $config;
    }

    /**
     * Calculate rainbow color
     * @param  number $numberOfData 
     * @param  number $index        
     * @return string               
     */
    private function getCalcRainbow($numberOfData, $index) {
        $frequency = 6 / $numberOfData;
        $red = floor(sin($frequency * $index + 0) * (127) + 128);
        $green = floor(sin($frequency * $index + 1) * (127) + 128);
        $blue = floor(sin($frequency * $index + 3) * (127) + 128);

        return sprintf('rgba(%s,%s,%s,.6)',$red, $green, $blue);
    }

    /**
     * Set HTMLElement ID for chart
     * @param string $id 
     */
    public function setElementId($id) {
        $this->elementId = $id;
    }

    /**
     * Retrieve HTMLElement ID
     * @return string
     */
    public function getElementId() {
        return $this->elementId;
    }

}
