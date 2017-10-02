<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class RadarChart extends AbstractChartType {
    /**
     * Type of chart
     * @var string
     */
    protected $chartType = 'radar';

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
