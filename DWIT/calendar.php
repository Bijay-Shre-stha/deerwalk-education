<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = array();

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = date('d'); //$date != null ? date('d', strtotime($date)) : date('d');
        // $e = ($this->active_month == 12 ? ($this->active_year+1):$this->active_year);
        // print_r($e);
        // die();
    }


    public function add_event($date_associated_events) {
        $this->events[] = $date_associated_events;
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar col-md-8">';
        $html .= '<div class="header">';
        $html .= '<div class="d-flex justify-content-center"><h4 class="calendar-name ">DWIT MONTHLY CALENDAR</h4></div>';
        
        $html .= '<div class="month-year d-flex justify-content-between">';
        $html .= '<div class="prev-month"><a href="?month=' . ($this->active_month - 1) . '&year=' . $this->active_year . '"> <span class="arrow">◄ </span>'.date('F Y',strtotime($this->active_year . '-' . ($this->active_month-1) )).'</a></div>';
        $html .= '<div class="current-month">' . date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';

        $next_year = ($this->active_month == 12 ? ($this->active_year+1):$this->active_year);
        $next_month = ($this->active_month == 12 ? 1:$this->active_month+1);
        
        $html .= '<div class="next-month"><a href="?month=' . $next_month . '&year=' . $next_year . '">'.date('F Y',strtotime($next_year . '-' . $next_month)).' <span class="arrow">►</span></a></div>';
        $html .= '</div>';
        $html .= '</div>';
       
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $calcDate = $this->active_year.'-'.$this->active_month."-".sprintf("%02d", $i);
            $todayEvent = $this->events[0][$calcDate][0];

            $day = strtolower(date('D', strtotime($calcDate)));

            $isWeekEnd = ($day == "sun" || $day == "sat") ? True: False;
            $hasEvent = $todayEvent == null ? False: True;

            $bgClass = "";

            if($hasEvent)
                $bgClass = "bg-has-event";
            elseif($isWeekEnd)
                $bgClass = "bg-is-holiday";

            $html .= '<div id="day_num_div_'.$i.'" class="day_num '.$bgClass.'" data-toggle="tooltip" data-placement="top" onclick="showEvent(this)" data-eventdate="'.$calcDate.'" title="'.$todayEvent.'">';
            $html .= '<span>' . $i . '</span>';
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';

        $dateSplit = explode('-',$date);
        $dateMonth = $dateSplit[1];
        $dateYear = $dateSplit[0]; 
        $html .= '<div class="monthly-events col-md-4">';
        $html .= '<div class="monthly-events-header">';
        $html .= '<h5 class="monthly-event-list-title">'.date('F', mktime(0, 0, 0, $this->active_month, 10)).' Events</h5>';
        $html .= '</div>';      //monthly-events-header-title
        $html .= '<div class="monthly-events-content">';    //monthly-events-content
        $html .= '<div class="monthly-events-content-list container">'; //monthly-events-content-list
        $html .= '<div>'; //div open
        
        
        if(empty($this->events[0]) != 1){
            foreach ($this->events as $event) {
                foreach($event as $date => $associated_events){
                    $html .= '<div class="row event-list mt-3 ">';   //row div open   
                    $html .= '<div class="col-2 col-md-2 col-sm-2 col-lg-2 event-date">
                                <div class="month-date">
                                    '.date('d',strtotime($date)).'
                                </div>
                                <div>
                                '.date('M',strtotime($date)).'
                                </div>
                            </div>';
                    $html .= '<div class="col-10 col-md-10 col-sm-10 col-lg-10" class="date-event-name"><p >'.$associated_events[0].'</p></div>';
                    $html .= '</div>';
                    // $html .= '<hr>';

                }
            }
        }
        else{
            $html .= '<div class="no-event-update text-center">Events Are Yet To Be Updated.</div>';
            $html .= '
                <script>
                    $(".monthly-events").css("height","8rem");
                    $(".monthly-events-content-list").css("all","unset");
                </script>
            ';
        }
        $html .= '</div>';  //row div close
        $html .= '</div>'; //div close
        $html .= '</div>'; //monthly-events-content-list
        $html .= '</div>'; //monthly-events-content
        return $html;
    }

}
?>
