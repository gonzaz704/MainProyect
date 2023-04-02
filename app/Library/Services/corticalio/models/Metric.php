<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/

/**
 * A semantic comparison values container.
 */
class Metric {

  static $swaggerTypes = array(
      'cosineSimilarity' => 'float',
      'euclideanDistance' => 'float',
      'overlappingAll' => 'int',
      'overlappingLeftRight' => 'float',
      'jaccardDistance' => 'float',
      'overlappingRightLeft' => 'float',
      'weightedScoring' => 'float',
      'sizeRight' => 'int',
      'sizeLeft' => 'int'

    );

  /**
  * Get Cosine-Similarity.
  */
  public $cosineSimilarity; // float
  /**
  * Get Euclidean-Distance.
  */
  public $euclideanDistance; // float
  /**
  * Get Overlapping-All.
  */
  public $overlappingAll; // int
  /**
  * Get Overlapping-Left-Right.
  */
  public $overlappingLeftRight; // float
  /**
  * Get Jaccard-Distance.
  */
  public $jaccardDistance; // float
  /**
  * Get Overlapping-Right-Left.
  */
  public $overlappingRightLeft; // float
  /**
  * Get the Weighted-Scoring.
  */
  public $weightedScoring; // float
  /**
  * Get Size-Right.
  */
  public $sizeRight; // int
  /**
  * Get Size-left.
  */
  public $sizeLeft; // int
  }

