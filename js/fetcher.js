// Copyright © 2019 MikeCoder

// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the "Software"),
// to deal in the Software without restriction, including without limitation
// the rights to use, copy, modify, merge, publish, distribute, sublicense,
// and/or sell copies of the Software, and to permit persons to whom the
// Software is furnished to do so, subject to the following conditions:

// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
// OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
// IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
// TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
// OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

function fetch_github_url(api_url) {
  var github_url = $("#wp_github_url_txt")[0].value;

  console.log(api_url);

  if (github_url === "") {
    alert("No Content");
    return;
  }

  $("#wp_github_url_btn")
    .attr("disabled", true)
    .css("pointer-events", "none");

  $("#wp_github_url_btn").html("Syncing...");

  $.ajax({
    url: api_url,
    data: { github_url: github_url },
    type: "POST",
    dataType: "json",
    complete: function(data) {
      $("#wp_github_url_btn")
        .attr("disabled", false)
        .css("pointer-events", "auto");
      $("#wp_github_url_btn").html("Sync");
    },
    success: function(data) {
      data = eval(data);

      if (data.status_code == 1) {
        $("#content-html")[0].click();
        $("#content")[0].value = data.content;
        $("#title")[0].value = data.title;
        $("#title-prompt-text").hide();
        $("#content-tmce")[0].click();
      } else {
        alert(data.message);
      }
    }
  });
}
