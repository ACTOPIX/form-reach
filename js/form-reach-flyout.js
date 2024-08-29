let formreach_flyoutButton = document.querySelector(".formreach_flyout-button");
let formreach_flyoutMenu = document.querySelector(".formreach_flyout-menu");
let formreach_menuOpen = false;

formreach_flyoutButton.addEventListener("click", () => {
    if (!formreach_menuOpen) {
        formreach_flyoutButton.style.pointerEvents = "none";
        formreach_flyoutMenu.style.display = "block";
        formreach_flyoutMenu.querySelectorAll("a").forEach((a, index) => {
            setTimeout(() => {
                a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
                a.style.transform = "scale(1)";
                a.style.opacity = "1";
            }, (2 - index) * 30);
        });
        setTimeout(() => {
            formreach_flyoutButton.style.pointerEvents = "auto";
        }, (2 + 1) * 30);
        formreach_menuOpen = true;
    } else {
        formreach_flyoutButton.style.pointerEvents = "none";
        formreach_flyoutMenu.querySelectorAll("a").forEach((a, index) => {
            setTimeout(() => {
                a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
                a.style.transform = "scale(0)";
                a.style.opacity = "0";
            }, index * 30);
        });
        setTimeout(() => {
            formreach_flyoutMenu.style.display = "none";
            formreach_flyoutButton.style.pointerEvents = "auto";
        }, (2 + 1) * 100);
        formreach_menuOpen = false;
    }
});