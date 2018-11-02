/*
    Defines the API route we are using.
*/
export const APP_CONFIG = {
    API_URL: 'http://new-framework.com/api/',
    moneyInputConfig: {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
        prefix: ''
    },
    defaultLanguage: 'en',
    languages: [
        {code: 'en', 'name': 'English'},{code: 'vi', name:'Tiếng Việt'}
    ]
}