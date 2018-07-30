<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Interop\Container\ContainerInterface;
use App\Entity\Trip;
use App\Repository\TripRepository as TripRepository;
use Doctrine\ORM\EntityManager;
use Slim\Http\UploadedFile;

class TripController
{
    protected $ci;

    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
    }

    public function upload(Request $request, Response $response, array $args) {
        $em = $this->ci->get('em');

        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['fileToUpload'];
        $name = $request->getParam('name');
        $newDirectory =  __DIR__ . '/uploads' . DIRECTORY_SEPARATOR . $name;
        $uploadedFile->moveTo($newDirectory);

        $gpx = simplexml_load_file($newDirectory);

        $name = $request->getParam('name');
        $user_id = $em->getRepository(\App\Entity\Users::class)->findOneBy(['username' => $_SESSION['username']]);

        foreach ($gpx->trk->trkseg->trkpt as $pt) {
            $lat = (string) $pt['lat'];
            $lon = (string) $pt['lon'];
            $ele = (string) $pt->ele;
            $result = explode('T', $pt->time);
            $date = $result[0];
            $result1 = explode('Z', $result[1]);
            $time = $result1[0];

            $em->getRepository(\App\Entity\Trip::class)->newTrip($name, $lon, $lat, $ele, $date, $time, $user_id);
        }
        unset($gpx);
    }

    public function getTrips(Request $request, Response $response, array $args) {
        $view = $this->ci->get('view');
        $em = $this->ci->get('em');
        $userId = $em->getRepository(\App\Entity\Users::class)->findOneBy(['username' => $_SESSION['username']]);

        $results = $em->getRepository(\App\Entity\Trip::class)->findTrips($userId->getId());

        $names = [];

        foreach($results as $result){
            array_push($names, $result['name']);
        }
        return $view->render($response, 'trips.twig', ['name' => $names]);
    }
}
