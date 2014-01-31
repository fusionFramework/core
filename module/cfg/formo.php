<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'title' => 'Formo',
	'description' => 'Form generation',
	'formo' => [
		'formo' => [
			'alias' => 'formo',
			'fields' => [
				['label_message_file', null, null, ['label' => 'Label message file', 'message' => 'File used for labels (FALSE or the name of the file)']],
				['validation_message_file', null, null, ['label' => 'Validation message file', 'message' => 'File used for validation messages (FALSE or the name of the file)']],
				['translate', 'radios', null, ['opts' => ['No', 'Yes'], 'message' => 'Whether to translate labels and error messages']],
				['close_single_html_tags', 'radios', null, ['label' => 'Close single html tags?', 'opts' => ['No', 'Yes']]],
				['namespaces', 'radios', null, ['opts' => ['No', 'Yes'], 'message' => 'Namespace fields (name="parent_alias[field_alias]")']],
				['auto_id', 'radios', null, ['label' => 'Auto id', 'opts' => ['No', 'Yes'], 'message' => 'Auto-generate IDs on form elements']],
				['model_base_rules', 'radios', null, ['label' => 'Model base rules', 'opts' => ['No', 'Yes'], 'message' => 'When using ORM driver, whether to automatically add mysql field base rules to formo field']],
				['template_dir', null, null, ['label' => 'Template dir', 'message' => 'The default view directory for the formo templates']]
			]
		]
	]
);
