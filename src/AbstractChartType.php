<?php 
namespace YusrilHs\ChartJsHelper;

use InvalidArgumentException;

abstract class AbstractChartType {

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
     * Retrieve type of chart
     * @return string
     */
    public final function getType() {
        return $this->chartType;
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
     * Generate chart configuration
     * @return array
     */
    abstract public function generate();

}
