var config = {
    paths: {
        'main': 'js/main',
        'bootstrapselect':'js/bootstrap-select.min',
        'newage': 'js/new-age',
        'bootstrapjs': 'vendor/bootstrap/js/bootstrap.bundle.min',
        'sweetalert': 'js/sweetalert.min'
    },
    shim: {
        'bootstrapselect': {
            deps: ['jquery']
        },
        'newage': {
            deps: ['jquery']
        },
        'bootstrapjs': {
            deps: ['jquery']
        },
        'sweetalert': {
            deps: ['jquery']
        },
        'main': {
            deps: ['jquery','newage','bootstrapselect']
        },
    }
};
