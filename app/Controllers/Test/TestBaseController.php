<?php

namespace App\Controllers\Test;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\Admin\TestModel;
use App\Models\Admin\TestApplicantModel;
use App\Models\Admin\TestTopicModel;
use App\Models\Admin\ApplicantModel;
use App\Models\Admin\TopicModel;
use App\Models\Admin\QuestionModel;
use App\Models\Admin\ResultModel;


class TestBaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['session', 'text'];
	public $data = [];
	public $testApplicantModel;
	public $testTopicModel;
	public $testModel;
	public $applicantModel;
	public $topicModel;
	public $questionModel;
	public $resultModel;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		$this->testModel = new TestModel();
		$this->testApplicantModel = new TestApplicantModel();
		$this->testTopicModel = new TestTopicModel();
		$this->applicantModel = new ApplicantModel();
		$this->topicModel = new TopicModel();
		$this->questionModel = new QuestionModel();
		$this->resultModel = new ResultModel();

		$userApplicant = $this->testApplicantModel->getSingleTestApplicant(session()->get('test_code'));

		$this->data['userApplicant'] = $userApplicant;
		$this->data['singleTest'] = $this->testModel->getSingleTest($userApplicant['id_tes']);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();0

	}
}
