<?php
App::uses ( 'AppController', 'Controller' );
/**
 * テスト
 * ☆履歴
 * 2014/9/24	新規作成
 *
 * @author k-uehara
 *
 */
class TestHasManyController extends AppController {
	public $name = 'TestHasMany';
	public $uses = array (
			'TestHasManyA',
			'TestHasManyB',
			'TestHasManyC'
	);
	public function index() {
		if (! empty ( $this->request->data )) {

			$dataSource = $this->TestHasManyA->getDataSource ();
			$dataSource->begin ();

			$this->TestHasManyA->saveAll ( $this->request->data ['TestHasManyA'], array (
					'atomic' => false
			) );
			$errors = $this->TestHasManyA->validationErrors;

			if (empty ( $errors )) {
				$this->TestHasManyB->saveAll ( $this->request->data ['TestHasManyB'], array (
						'atomic' => false
				) );
				$errors = $this->TestHasManyB->validationErrors;
			}
			if (empty ( $errors )) {
				$this->TestHasManyC->saveAll ( $this->request->data ['TestHasManyC'], array (
						'atomic' => false
				) );
				$errors = $this->TestHasManyC->validationErrors;
			}

			if (empty ( $errors )) {
				$dataSource->commit ();
			} else {
				$dataSource->rollback ();
			}
		} else {
		}

		$data = $this->TestHasManyA->find ( 'all' );

		$this->set ( array (
				'data' => $data
		) );
	}

}