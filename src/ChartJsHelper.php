<?php 
namespace YusrilHs\ChartJsHelper;

use InvalidArgumentException;

class ChartJsHelper {

    /**
     * ChartType class map
     * @var array
     */
    protected static $chartTypeMap = array(
        'bar' => '\\ChartType\\BarChart',
        'doughnut' => '\\ChartType\\DoughnutChart',
        'line' => '\\ChartType\\LineChart',
        'mixed' => '\\ChartType\\MixedChart',
        'pie' => '\\ChartType\PieChart',
        'polar' => '\\ChartType\PolarAreaChart',
        'radar' => '\\ChartType\RadarChart'
    );

    /**
     * ChartType Builder
     * @param  string $chartType 
     * @return YusrilHs\ChartJsHelper\AbstractChartType            
     */
    public static function createChart($chartType) {
        if (!isset(self::$chartTypeMap[$chartType])) {
            throw new InvalidArgumentException(sprintf('Chart %s is not defined', $chartType));
        }
        $class = __NAMESPACE__ . self::$chartTypeMap[$chartType];
        return new $class();
    }

}
