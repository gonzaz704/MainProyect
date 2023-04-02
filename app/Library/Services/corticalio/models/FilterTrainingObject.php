<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/

/**
 * Represents training input for a classification filter.
 */
class FilterTrainingObject {

  static $swaggerTypes = array(
      'positiveExamples' => 'array[Text]',
      'negativeExamples' => 'array[Text]'

    );

  /**
  * Get positive examples
  */
  public $positiveExamples; // array[Text]
  /**
  * Get negative examples
  */
  public $negativeExamples; // array[Text]
  }

