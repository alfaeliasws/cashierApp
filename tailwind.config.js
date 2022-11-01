/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin")

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
      theme: {
        extend: {
            fontFamily: {
            sans:['Source Sans Pro','ui-sans-serif','system-ui'],
            mono:['Source Code Pro','ui-monospace']
            },
            fontSize: {
            big:"3rem"
            },
            letterSpacing: {
            semi:"0.12rem",
            kinda:"0.15rem",
            kindof:"0.2rem",
            quite:"0.25rem",
            ql:"0.35rem",
            large:"0.5rem",
            super:"1 rem"
            },
            utilities:{
            },
            colors:{
            main:{
                "50":"#201F1F",
                "100":"#181717",
                "200":"#1B1919",
                "300":"#121111"
            },
            bluemain:{
                "dark-1":"#231955",
                "dark-2":"#082264",
                "dark-3":"#1a1533",
                "dark-4":"#120f24",
                "dark-5":"#241E48",
                "dark-6":"#362D6C",
                "light":"#1F4690",
                "light-2":"#3E8CFF",
            },
            yellowmain:{
                "dark":"#E8AA42",
                "light":"#FFE5B4",
            }
            },
            brightness:{
            115:'1.15'
            },
            flexGrow:{
            '2':2
            }
        },
        },
        plugins: [
        plugin(function({addUtilities}){
            const utilities = {
            ".shadow-skill":{
                "box-shadow": "0px 10px 30px rgba(0, 0, 0, 1)"
            },
            ".shadow-new":{
                "box-shadow": "0px 10px 20px rgba(0, 0, 0, 1)"
            },
            ".shadow-newest":{
                "box-shadow": "0px 5px 10px rgba(0, 0, 0, 1)"
            },
            }

            addUtilities(utilities);
        })
        ],
        variants: {
        scrollbar: ['rounded'],
        }
    }
