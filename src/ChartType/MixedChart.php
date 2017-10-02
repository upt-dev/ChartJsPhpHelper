<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class MixedChart extends AbstractChartType {
    
    /**
     * Set type of mixed chart
     * @param string $type
     */
    public function setType($type) {
        $this->chartType = $type;
    }

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
