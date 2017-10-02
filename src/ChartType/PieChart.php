<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class PieChart extends AbstractChartType {
    /**
     * Type of chart
     * @var string
     */
    protected $chartType = 'pie';

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
