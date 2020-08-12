<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/*$jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
$data = json_decode($jsonData, true);  //Convertir en array*/

/*foreach($data as $key => $value){
    $jours_count = count($value)-1;
    $jours_count_pres = $jours_count -1;
}*/

class CovidApiController extends AbstractController
{
    private $dataApi;
    private $jsonData;
    private $days_count;
    private $days_count_prev;

    public function __construct()
    {
        $this->jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
        $this->dataApi = json_decode($this->jsonData, true);
    }
    /**
     * @Route("/", name="covid_api")
     */
    public function index()
    {
        foreach ($this->dataApi as $key => $value) {
            $this->days_count = count($value) - 1;
            $this->days_count_prev = $this->days_count - 1;
        }
        return $this->render('covid_api/index.html.twig', [
            'controller_name' => 'CovidApiController',
            'data' => $this->dataApi
        ]);
    }
}

/**{% if data is defined %}
					{% for key, value in data %}
						<!-- set increase = value.days_count.confirmed - value.days_count_prev.confirmed %}-->
						<tr>
							<th scope="row">{{key}}</th>
							<td>
								{{ value.confirmed }}

							</td>
						</tr>
					{% endfor %}
				{% endif %} */
