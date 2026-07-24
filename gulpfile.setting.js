module.exports = {
	SASS : {
		SOURCE_PATH : 'source/assets/css',
        SOURCE_FILE : '**/*.scss',
        OUTPUT_PATH : 'wp-theme/assets/css',
		OPTION : {
			outputStyle : 'expanded'
		},
		AUTOPREFIXER : { cascade : false },
	},
	BROWSERSYNC : {
		DOCUMENT_ROOT : 'public',
		STARTPATH : '',
		NOTIFY : false,
		GHOSTMODE : {
			clicks : false,
			forms : false,
			scroll : false
		},
	},
};
