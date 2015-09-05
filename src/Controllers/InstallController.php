<?php
namespace Idiaz\Controllers;

use Spot\Locator;
use Spot\Mapper;
use Idiaz\HttpResponse;

/**
 * InstallController
 */
class InstallController
{
    private $idiazMapper;
    private $response;

    public function __construct(HttpResponse $response, \Spot\MapperInterface $idiazMapper)
    {
        $this->response = $response;
        $this->idiazMapper = $idiazMapper;
    }

    public function index($request, $response)
    {
        $this->response->make($response, 'install.twig');
    }

    public function table($request, $response)
    {
        $this->idiazMapper->migrate();

        return $response->write('Table created successfully.');
    }

    public function data($request, $response)
    {
        $this->idiazMapper->create([
            'title' => 'Idea One',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->idiazMapper->create([
            'title' => 'Idea Two',
            'content' => 'When bat hey as swung well due conductive the so passably cobra one articulate other toucan ground when yikes seal goldfish bled oriole beyond much salamander terrier.\r\n\r\nHello crud sold in assisted jeeringly and tasteful dear more tranquilly this much since surreptitiously sleekly pending that where excepting some antagonistically in above hey rethought sent robin a eagle rethought jeez less.\r\n\r\nMonkey gosh artificially until as until unwillingly forgot as and shy gosh that clumsy above oh circa underlay far retrospectively some monstrously ouch experimental beneath rubbed buffalo some less far far abject far turned.',
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->idiazMapper->create([
            'title' => 'Idea Three',
            'content' => 'This is a new idea I want to add and make sure that the original idea setup is working. I am so happy I have moved this away from CodeIgniter.\r\n\r\nTest etst test.',
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        return $response->write('Data installed successfully.');
    }
}
