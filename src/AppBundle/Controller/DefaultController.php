<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(Request $request)
    {
        $requestSha1 = $request->request->get('sha1');
        $file = $request->files->get('file');

        /* @var $file UploadedFile */

        $uploadedFileSha1 = sha1_file($file->getPathname());

        $match = $uploadedFileSha1 === $requestSha1;

        $matchStr = $match ? 'matches' : 'does not match';

        $fs = new Filesystem();

        $fs->remove($this->getParameter('kernel.root_dir').'/../'.'huge_file_saved');

        if ($match) {
            $file->move($this->getParameter('kernel.root_dir').'/../', 'huge_file_saved');
        }

        $memoryUsage = round(memory_get_peak_usage() / 1024 / 1024, 2);

        return new Response(<<<EOT
<html>
    <body>
        <div>
            Memory usage: {$memoryUsage}M
        </div>
        <div>
        Sha1: $matchStr
        <div>
            Request: $requestSha1
        </div>
        <div>
            File: $uploadedFileSha1
        </div>
        </div>
    </body>
</html>
EOT
        );
    }
}
