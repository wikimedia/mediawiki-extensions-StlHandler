<?php
/**
 *
 * Handler for stl files.
 *
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */
 class StlHandler extends ImageHandler {
	public static function onBeforePageDisplay ( OutputPage $out, Skin $skin){
		if (substr($out->getTitle()->getPrefixedText(),0)==="file:"){ //is file page
				if( $out->getWikiPage()->getFile()->getMimeType() === 'application/sla' ){
					$out->addModules('ext.StlHandler');
				}
			}
		}

	public static function onImageOpenShowImageInlineBefore( $imagepage, $out ){
		if ( $imagepage->getDisplayedFile()->getMimeType() === 'application/sla' ){
			$full_url = $imagepage->getDisplayedFile()->getFullURL();
			$out->addHtml(                                          
"<div class='fullMedia'><div id='viewer'><canvas id='stlCanvas' width='600' height='400' style='background:lightgrey;'></canvas></div><span class='fileInfo'>$longDesc</span></div>");
			$out->addHtml(ResourceLoader::makeInlineScript("mw.loader.using( 'ext.StlHandler',
									function(){
										initScene('$full_url');
									});"
			) );
		}
	}
	 function doTransform( $image, $dstPath, $dstUrl, $params, $flags = 0){
	}
}