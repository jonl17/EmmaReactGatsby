<?php
if(MiscOptions::$phoneLayoutActive){?>

		<div id="create-phone-layout-modal" class="lay-input-modal">
			<div class="panel panel-default">
		    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="panel-body">
					<p class="lead text-center">Creating custom phone layout for the first time.<br>How do you want to start with your phone layout?</p>
					<span class="create-phone-layout-tooltip" data-toggle="tooltip" data-placement="top" title="Row attributes like row backgrounds and empty rows will be omitted.">
					    <button type="button" class="btn btn-default js-cpl-stack">Stack elements on top of each other</button>
					</span>
					<button type="button" class="btn btn-default js-cpl-copy">Copy same layout</button>
					<button type="button" class="btn btn-default js-cpl-empty">Start with empty layout</button>
					<p class="text-center create-phone-layout-descr" style="color: lightgray;">The Frame and Row Gutter will use values of "Lay Options" &rarr; "Gridder Defaults" &rarr; "Phone Gridder Defaults".</p>
				</div>
			</div>
			<div class="background"></div>
		</div>

		<div id="confirm-delete-phone-layout-modal" class="lay-input-modal">
			<div class="panel panel-default">
		    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="panel-body">
					<p class="lead text-left">Delete custom phone layout?</p>
					<div class="text-right">
						<span class="cdpl-tooltip" data-toggle="tooltip" data-placement="left" title="Without a custom phone layout, the layout on phones will be the standard stacked layout.">
						    <button type="button" class="btn btn-default js-cdpl-yes">Delete</button>
						</span>
						<button type="button" class="btn btn-default js-cdpl-no">Cancel</button>
					</div>
				</div>
			</div>
			<div class="background"></div>
		</div>

<?php } ?>

		<div id="bg-video-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-bg-video-modal-title">Set Row Video Background</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<div class="form-group bg-video-group">
						<div class="row">
							<div class="col-md-6">
								<div><button type="button" class="btn btn-default btn-sm js-bg-video-set-mp4 mp4-btn">Set .mp4</button><span class="filename js-bg-video-mp4-filename"></span></div>
								<div class="checkbox"><label><input type="checkbox" checked="checked" class="js-bg-video-mute"> <span>Mute Video</span></label></div>
								<div><button type="button" class="btn btn-default btn-sm js-bg-video-set-image image-btn">Set placeholder image</button></div>
								<div class="bg-video-image-thumb"></div>
							</div>
							<div class="col-md-6">

							</div>
						</div>
					</div>
					<p>A row video background is an autoplaying, looping HTML5 video.</p>
					<p>The placeholder image will be shown on mobile devices instead of the video, because autoplaying videos are not supported on mobile. But you could use a gif as a placeholder for example.</p>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg bg-video-add-video-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="html5-video-input-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-html5-video-modal-title">Add HTML5 Video</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<div class="form-group html5-video-group">
						<div class="row">
							<div class="col-md-6">
								<div><button type="button" class="btn btn-default btn-sm js-set-mp4 mp4-btn">Set .mp4</button>* <span class="filename js-mp4-filename"></span></div>
								<div><button type="button" class="btn btn-default btn-sm js-set-poster poster-btn">Set placeholder image</button>*</div>
								<div class="html5-video-poster-thumb"></div>
							</div>
							<div class="col-md-6">
								<div class="checkbox"><label><input type="checkbox" class="js-autoplay"> <span>Autoplay</span></label></div>
								<div class="checkbox js-playpauseonclick-wrap"><label><input type="checkbox" class="js-playpauseonclick"> <span>Play/pause on click</span></label></div>
								<div class="checkbox"><label><input type="checkbox" class="js-loop"> <span>Loop</span></label></div>
								<div class="checkbox"><label><input type="checkbox" class="js-mute"> <span>Mute</span></label></div>
								<div class="checkbox"><label><input type="checkbox" class="js-controls"> <span>Show Standard Controls</span></label></div>
								<div class="checkbox"><label><input type="checkbox" class="js-playicon"> <span>Show Custom "Play" Icon</span></label></div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-video-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="video-input-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-video-modal-title">Add Video</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<div class="alert alert-danger" role="alert"><strong>Malformed address!</strong> Please check if this is a valid YouTube or Vimeo address.</div>
					<input type="text" class="form-control input-lg" placeholder="YouTube or Vimeo address">
					<div class="media">
					  <div class="pull-left">
					    <img id="video-preview" class="media-object" src="" alt="">
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading"></h4>
					    <p></p>
					  </div>
					</div>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-video-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="embed-input-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-embed-modal-title">Add Embed</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<div class="alert alert-danger" role="alert">Error, no embed found for this URL.</div>
					<input type="text" class="form-control input-lg" placeholder="Enter a URL">
					<div class="embed-preview-wrap">
						<div id="embed-preview">
							<span class="dashicons dashicons-format-image"></span>
						</div>
					</div>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-embed-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="html-input-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-html-modal-title">Add HTML</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<div id="ace-html-modal-editor"></div>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-html-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="shortcode-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-shortcode-modal-title">Add Shortcode</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<input type="text" class="form-control input-lg js-shortcode-input">
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-shortcode-btn" disabled="disabled">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>

		<div id="lay-link-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title">Link</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
				<div class="panel-body">
					<input type="text" class="form-control input-lg js-link-url" placeholder="http://laytheme.com">
					<div class="link-image-checkbox-wrap">
						<input type="checkbox" class="js-new-tab" id="new-tab">
						<label for="new-tab">Open link in a new tab</span>
					</div>
				</div>
				<div class="panel-footer clearfix">
					<button type="button" class="btn btn-default btn-lg remove-link-btn">Remove Link</button>
					<button type="button" class="btn btn-default btn-lg edit-link-btn">Save</button>
				</div>
			</div>
			<div class="background"></div>
		</div>

		<div id="edit-html-class-id-modal" class="lay-input-modal">
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title">Set HTML class and id</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
			  	<div class="panel-body">
			  		<p>HTML classes and ids can't contain special characters and can't start with a number. An id needs to be unique on its page. You can assign multiple classes separated by spaces but you can only assign one id.</p>
			  		<div class="form-group">
			  			<label for="lay-html-class-input">class</label>
			  			<input id="lay-html-class-input" type="text" placeholder="myclass anotherclass" class="form-control js-html-class">
			  		</div>
			  		<div class="form-group">
			  			<label for="lay-html-id-input">id</label>
			  			<input id="lay-html-id-input" type="text" placeholder="myid" class="form-control js-html-id">
		  			</div>
			  	</div>
				<div class="panel-footer clearfix">
					<button type="button" class="btn btn-default btn-lg edit-class-btn">Save</button>
				</div>
			</div>
			<div class="background"></div>
		</div>

		<div id="text-input-modal" class="lay-input-modal">
			<div class="text-modal-notices-wrap">
			<?php
				if(get_option( 'lay_show_texteditor_notice_for_linebreak', '' ) == ''){
					echo
					'<div data-optionname="lay_show_texteditor_notice_for_linebreak" class="alert alert-info text-modal-notice notice_for_linebreak" role="alert">
						Press "Shift" + "Enter" for a linebreak. Press only "Enter" for a new paragraph.
						<button type="button" class="btn btn-default btn-xs dont-show-again">Don\'t show again</button>
						<button type="button" class="btn btn-default btn-xs next-tip">Next tip</button>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>';
				}
				if(get_option( 'lay_show_texteditor_notice_for_textformats', '' ) == ''){
					echo
					'<div data-optionname="lay_show_texteditor_notice_for_textformats" class="alert alert-info text-modal-notice" role="alert">
						Want to change the default Text Style? Or create a Text Style for Paragraphs or Headlines and use it anywhere? <a target="_blank" href="'.get_admin_url( null, "admin.php?page=manage-textformats").'">Use Textformats!</a>
						<button type="button" class="btn btn-default btn-xs dont-show-again">Don\'t show again</button>
						<button type="button" class="btn btn-default btn-xs next-tip">Next tip</button>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>';
				}
				if(get_option( 'lay_show_texteditor_notice_for_clear_formatting', '' ) == ''){
					echo
					'<div data-optionname="lay_show_texteditor_notice_for_clear_formatting" class="alert alert-info text-modal-notice" role="alert">
						Did you apply a Text Format but it doesn\'t look right? Try these steps:
						<div style="margin: 10px 0;">
							- Select your text<br>
							- Click <img src="'.get_template_directory_uri().'/gridder/assets/img/textmodal_notices/clear_formatting.png" alt=""> "Clear formatting"<br>
							- Apply your Text Format
						</div>
						<button type="button" class="btn btn-default btn-xs dont-show-again">Don\'t show again</button> <button type="button" class="btn btn-default btn-xs next-tip">Next tip</button>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>';
				}
				if(get_option( 'lay_show_texteditor_notice_for_nonbreakingspace', '' ) == ''){
					echo
					'<div data-optionname="lay_show_texteditor_notice_for_nonbreakingspace" class="alert alert-info text-modal-notice" role="alert">
						Need a space but want to prevent a linebreak? Use a <img src="'.get_template_directory_uri().'/gridder/assets/img/textmodal_notices/nonbreaking_space.png" alt=""> "Nonbreaking space".
						<button type="button" class="btn btn-default btn-xs dont-show-again">Don\'t show again</button> <button type="button" class="btn btn-default btn-xs next-tip">Next tip</button>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>';
				}
				if(get_option( 'lay_show_texteditor_notice_for_softhyphen', '' ) == ''){
					echo
					'<div data-optionname="lay_show_texteditor_notice_for_softhyphen" class="alert alert-info text-modal-notice" role="alert">
						Have a long word that overflows its text column? Use a <img src="'.get_template_directory_uri().'/gridder/assets/img/textmodal_notices/soft_hyphen.png" alt=""> "Soft hyphen" to make the word break at a certain position. <a href="http://en.wikipedia.org/wiki/Soft_hyphen" target="_blank">more info</a>
						<button type="button" class="btn btn-default btn-xs dont-show-again">Don\'t show again</button>
						<button type="button" class="btn btn-default btn-xs next-tip">Close</button>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>';
				}
				// attention! only last tip should have 'close' as next-button text instead of 'next tip'
			?>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title js-text-modal-title">Add Text</h3>
			    	<button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  	</div>
			  	<div class="panel-body">
					<?php
					wp_editor( "", "gridder_text_editor", Gridder::$tinymceSettings );
					?>
				</div>
				<div class="panel-footer clearfix"><button type="button" class="btn btn-default btn-lg add-text-btn">Ok</button></div>
			</div>
			<div class="background"></div>
		</div>
