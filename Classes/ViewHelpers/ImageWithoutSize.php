<?php
namespace TYPO3\crt_viewhelper\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class ImageWithoutSizeViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper {

	/**
	 * Initialize arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();
	}

	public function render($src = NULL, $width = NULL, $height = NULL, $minWidth = NULL, $minHeight = NULL, $maxWidth = NULL, $maxHeight = NULL, $treatIdAsReference = FALSE, $image = NULL) {
		if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must either specify a string src or a File object.', 1382284106);
		}
		$image = $this->imageService->getImage($src, $image, $treatIdAsReference);
		$processingInstructions = array(
			'width' => $width,
			'height' => $height,
			'minWidth' => $minWidth,
			'minHeight' => $minHeight,
			'maxWidth' => $maxWidth,
			'maxHeight' => $maxHeight,
		);
		$processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
		$imageUri = $this->imageService->getImageUri($processedImage);

		$this->tag->addAttribute('src', $imageUri);

		$alt = $image->getProperty('alternative');
		$title = $image->getProperty('title');

		// The alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
		if (empty($this->arguments['alt'])) {
			$this->tag->addAttribute('alt', $alt);
		}
		if (empty($this->arguments['title']) && $title) {
			$this->tag->addAttribute('title', $title);
		}

		return $this->tag->render();
	}
}

?>