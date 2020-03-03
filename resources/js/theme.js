export const Theme = {
    getColor() {
        this.axios.get("/api/settings").then(response => {
            this.colors = response.data;
            if (this.colors.color == "defaultColor") {
                document.getElementById("schoolName").style.background = "#1b5e20";
                var dark = document.getElementsByClassName("dropdownForm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#044604";
                }
                var dark = document.getElementsByClassName("item-body");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderTop = "solid #1b5e20 1px";
                }
                var dark = document.getElementsByClassName("item");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "#1b5e20";
                }
                var dark = document.getElementsByClassName("router");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "#1b5e20";
                }
                var dark = document.getElementsByClassName("mobile");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("block1");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.border = "2px solid rgb(252, 239, 44)";
                }
                var dark = document.getElementsByClassName("content");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("card");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "khaki";
                }
                var dark = document.getElementsByClassName("card-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("sub-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("save");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("searchButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("viewButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("edit");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("editSm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#d8d8d8";
                }
                var dark = document.getElementsByClassName("bigView");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("Links");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
                var dark = document.getElementsByClassName("smLink");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e20";
                }
            } else if (this.colors.color == "redColor") {
                var dark = document.getElementsByClassName("block2");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.border = "2px solid rgb(252, 239, 44)";
                }
                var dark = document.getElementsByClassName("item-body");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderTop = "solid darkred 1px";
                }
                var dark = document.getElementsByClassName("router");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "darkred";
                }
                var dark = document.getElementsByClassName("mobile");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkred";
                }
                var dark = document.getElementsByClassName("item");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "darkred";
                }
                var dark = document.getElementsByClassName("content");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkred";
                }
                document.getElementById("schoolName").style.background = "darkred";
                var dark = document.getElementsByClassName("dropdownForm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#670404";
                }
                var dark = document.getElementsByClassName("card");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkgrey";
                }
                var dark = document.getElementsByClassName("card-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("sub-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("save");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("searchButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("viewButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("edit");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
                var dark = document.getElementsByClassName("editSm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#d8d8d8";
                }
                var dark = document.getElementsByClassName("bigView");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "rgb(139, 0, 0)";
                }
                var dark = document.getElementsByClassName("Links");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "rgb(139, 0, 0)";
                }
                var dark = document.getElementsByClassName("smLink");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#5e1b1b";
                }
            } else if (this.colors.color == "blueColor") {
                var dark = document.getElementsByClassName("block3");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.border = "2px solid rgb(252, 239, 44)";
                }
                var dark = document.getElementsByClassName("item-body");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderTop = "solid darkcyan 1px";
                }
                var dark = document.getElementsByClassName("router");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "darkcyan";
                }
                var dark = document.getElementsByClassName("mobile");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkcyan";
                }
                var dark = document.getElementsByClassName("item");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "darkcyan";
                }
                var dark = document.getElementsByClassName("content");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkcyan";
                }
                document.getElementById("schoolName").style.background = "darkcyan";
                var dark = document.getElementsByClassName("dropdownForm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#016868";
                }
                var dark = document.getElementsByClassName("card");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "powderblue";
                }
                var dark = document.getElementsByClassName("card-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("sub-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("save");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("searchButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("viewButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("edit");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
                var dark = document.getElementsByClassName("editSm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#d8d8d8";
                }
                var dark = document.getElementsByClassName("bigView");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkcyan";
                }
                var dark = document.getElementsByClassName("Links");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "darkcyan";
                }
                var dark = document.getElementsByClassName("smLink");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#1b5e5e";
                }
            } else if (this.colors.color == "darkColor") {
                var dark = document.getElementsByClassName("block4");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.border = "2px solid rgb(252, 239, 44)";
                }
                var dark = document.getElementsByClassName("item-body");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderTop = "solid currentColor 1px";
                }
                var dark = document.getElementsByClassName("router");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "currentColor";
                }
                var dark = document.getElementsByClassName("item");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "currentColor";
                }
                var dark = document.getElementsByClassName("mobile");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "currentColor";
                }
                var dark = document.getElementsByClassName("content");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "currentColor";
                }
                document.getElementById("schoolName").style.background =
                    "currentColor";
                var dark = document.getElementsByClassName("dropdownForm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#383c40";
                }
                var dark = document.getElementsByClassName("card");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "gainsboro";
                }
                var dark = document.getElementsByClassName("card-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("sub-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("save");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("searchButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("viewButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("edit");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("editSm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#d8d8d8";
                }
                var dark = document.getElementsByClassName("bigView");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#212529";
                }
                var dark = document.getElementsByClassName("Links");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#212529";
                }
                var dark = document.getElementsByClassName("smLink");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
            } else if (this.colors.color == "lightColor") {
                var dark = document.getElementsByClassName("block5");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.border = "2px solid rgb(252, 239, 44)";
                }
                var dark = document.getElementsByClassName("router");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("item-body");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderTop = "solid black 1px";
                }
                var dark = document.getElementsByClassName("item");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("line");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "black";
                }
                var dark = document.getElementsByClassName("mobile");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.backgroundColor = "#dee3de";
                }
                var dark = document.getElementsByClassName("fontColour");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("moreInformation");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("content");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "white";
                }
                var dark = document.getElementsByClassName("tabTheme");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("sidebar_header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                    dark[color].style.background = "white";
                    dark[color].style.borderBottom = "1px solid #656565";
                }
                var dark = document.getElementsByClassName("smallIcon");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("expandsidebar");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "white";
                }
                var dark = document.getElementsByClassName("dropdownForm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                }
                var dark = document.getElementsByClassName("card");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#eef1ea";
                }
                var dark = document.getElementsByClassName("card-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("sub-header");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("save");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("searchButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("viewButton");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("edit");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                    dark[color].style.background = "#dee3de";
                }
                var dark = document.getElementsByClassName("editSm");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "black";
                    dark[color].style.background = "white";
                }
                var dark = document.getElementsByClassName("bigView");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "white";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("Links");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "white";
                }
                var dark = document.getElementsByClassName("smLink");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.background = "#dee3de";
                    dark[color].style.color = "black";
                }
                var dark = document.getElementsByClassName("navList");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.borderBottom =
                        "1px solid rgba(199, 199, 199, 0.75)";
                }
                var dark = document.getElementsByClassName("additional-menu");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "#000000d4";
                }
                var dark = document.getElementsByClassName("link");
                var color;
                for (color = 0; color < dark.length; color++) {
                    dark[color].style.color = "#000000d4";
                }
            }
        });
    }
}