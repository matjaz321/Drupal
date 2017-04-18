<?php

namespace Drupal\ad_general\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\Core\Entity\EntityManagerInterface;
use Drupal\node\Entity\Node;
/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "event_days",
 *   admin_label = @Translation("Event Days1"),
 * )
 */
class TestingHelloBlock extends BlockBase implements BlockPluginInterface
{
  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
	if ($node) 
	{
		$nid = $node->id();
		$node2 = node_load($nid); //getting node
		  //date_default_timezone_set('Europe/Berlin');
		 // $gmtTimeZone = new \DateTimeZone('Europe/Berlin');
		$stringDate = $node2->get('field_event_start_date')->getString(); //getting field_date
		$arrayDate = explode("T", $stringDate); //splitting string where T1 appears
		$result = $arrayDate[0]." ".$arrayDate[1]; //combining into string
		$date_timestamp = strtotime($result);


		$currentDate = date("d-m-Y H:i:s"); //getting current date
		$currentDate_timestamp = strtotime($currentDate); //converting it to timestmap

	  	$start = date('Y-m-d H:i:s',$date_timestamp); 
	    $end = date('Y-m-d H:i:s',$currentDate_timestamp); 
	    $start = $this->convertDateFromTimezone($start,'UTC', 'Europe/Ljubljana','d-m-Y H:i:s');
	    $d_start = new \DateTime($start); 
	    $d_end = new \DateTime($end); 
	    $interval = $d_start->diff($d_end);


		$output = array();
		$output[]['#cache']['max-age'] = 0;
		//test 

		if($d_start < $d_end){ //če je dni manj
			$output[] = [ '#markup' => 'The event has ended.',];
	  	}
		else if ($interval->format('%a') == 0 ) { //če je event da enaki dan in če je v izvajanju
	  		$output[] = [ '#markup' => 'The event is in progress.',];
		}
		else if ($interval->format('%a') > 0) { //če je dni več 
	  		$output[] = [ '#markup' => 'Days left to event start: '.$interval->format('%a').'.',];
		}
	  	return $output;
	}
  }  
  function format_interval(DateInterval $interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
  }
  function convertDateFromTimezone($date,$timezone,$timezone_to,$format){
	 $date = new \DateTime($date,new \DateTimeZone($timezone));
	 $date->setTimezone( new \DateTimeZone($timezone_to) );
	 return $date->format($format);
	}
}                                   