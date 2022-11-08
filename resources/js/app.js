import './bootstrap';

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import PerfectScrollbar from "perfect-scrollbar";

window.PerfectScrollbar = PerfectScrollbar;

document.addEventListener("alpine:init", () => {
    Alpine.data("mainState", () => {
        let lastScrollTop = 0;
        const init = function () {
            window.addEventListener("scroll", () => {
                let st =
                    window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    // downscroll
                    this.scrollingDown = true;
                    this.scrollingUp = false;
                } else {
                    // upscroll
                    this.scrollingDown = false;
                    this.scrollingUp = true;
                    if (st == 0) {
                        //  reset
                        this.scrollingDown = false;
                        this.scrollingUp = false;
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
            });
        };

        const getTheme = () => {
            if (window.localStorage.getItem("dark")) {
                return JSON.parse(window.localStorage.getItem("dark"));
            }
            return (
                !!window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            );
        };
        const setTheme = (value) => {
            window.localStorage.setItem("dark", value);
        };
        return {
            init,
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                setTheme(this.isDarkMode);
            },
            isSidebarOpen: window.innerWidth > 1024,
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return;
                }
                this.isSidebarHovered = value;
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false;
                } else {
                    this.isSidebarOpen = true;
                }
            },
            scrollingDown: false,
            scrollingUp: false,
        };
    });
});

Alpine.plugin(collapse);

Alpine.start();

//
//
// const messages_el = document.getElementById('messages');
// const userId_input = document.getElementById('userId');
// const roomId_input = document.getElementById('roomId');
// const message_input = document.getElementById('message_input');
// const message_form = document.getElementById('message_form');
//
// message_form.addEventListener('submit', (e) => {
//
//     e.preventDefault();
//     let has_errors = false;
//     if (userId_input.value.length < 1) {
//         has_errors = true;
//         userId_input.classList.add('border-red-500');
//     }
//     if (roomId_input.value.length < 1) {
//         has_errors = true;
//         roomId_input.classList.add('border-red-500');
//     }
//     if (message_input.value.length < 1) {
//         has_errors = true;
//         message_input.classList.add('border-red-500');
//     }
//     if (has_errors) {
//         return;
//     }
//
//     const options = {
//         method: 'POST',
//         url: '/send-message',
//         data: {
//             roomId: roomId_input.value,
//             userId: userId_input.value,
//             message: message_input.value,
//         }
//     }
//
//     axios(options);
// });
// // // echo listen to message sent event
// // Echo.channel('chat')
// //     .listen('message', (e) => {
// //         console.log(e);
// // });
//
// window.Echo.channel('chat')
//     .listen('.message', (e) => {
//     console.log(e);
// });

// window.Echo.channel(`room`)
//     .listen('join-room', (e) => {
//         console.log("labas");
//     });
