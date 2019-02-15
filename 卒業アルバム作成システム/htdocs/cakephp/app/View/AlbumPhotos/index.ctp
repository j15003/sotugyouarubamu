<?php echo $this->Html->css('stylesheet.css') ?>
<div class="albumPhotos index">
		<br><br>

		<soeda><?php echo __('アルバムの作成画面'); ?></soeda>

			<?php echo $this->Form->create('AlbumPhoto'); ?>
				<fieldset>
					<sub0><?php echo __('アルバム名を入力してください'); ?></sub0>
				<?php
					echo $this->Form->input('album_name', array('label' => 'アルバム名' ));
					// echo $this->Form->input('people_name', $arrayName = array('label' => '写ってる人の名前(1人指定、ローマ字のみ)'));
					// echo $this->Form->input('photo_name', $arrayName = array('label' => '写真データの名前'));
				//	echo $this->Form->input('modifid');
				?>
				</fieldset>
				<br>
				<sub0>顔学習モデルを選択してください</sub0>
				<?php
				//radioボタンを作る
				$models = array('J1モデル'=>'J1モデル', 'J2モデル'=>'J2モデル',
				 								'J3モデル'=>'J3モデル', 'J4モデル'=>'J4モデル');
			 	echo $this->Form->input('model_name',
													array('options'=>$models,
																'label' =>'<sub1>顔学習モデルを選択してください</sub1>',
																'type'=>'radio',
																'legend'=>false,
																));

				echo $this->Form->end(__('次へ'));
				?>
</div>
