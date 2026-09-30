<?php
/**
 * @title      Video
 * @section    features
 * @type       feature
 * @breadcrumb true
 * @position   7
 * @kicker     Plugin
 * @abstract   Local video files with a poster picked automatically at build time, and silent looping clips.
 */
?>

<div class="prose">
    <markdown>
    [`@kirigami/plugin-clip`](https://www.npmjs.com/package/@kirigami/plugin-clip)
    is the local counterpart of `<youtube>` / `<vimeo>`: a video file served from
    your own site. The poster is not the first frame — at build time
    `@kirigami/bestframe` samples the video, drops black, flat and blurry frames,
    and lets a small embedded aesthetic model pick the best one.

    ### A video card

    ```html
    <clip src="media/zoom.mp4">
    ```
    </markdown>

    <clip src="media/zoom.mp4">

    <markdown>
    The poster is written to `assets/images/clip/` and published through the image
    pipeline (resized, in the project's format). Nothing is downloaded from the
    video until the play button is pressed. The result is cached in
    `src/_data/clip/`, because choosing a frame is slow — commit it.

    From Markdown: `{% clip media/zoom.mp4 %}`.

    ### A silent loop

    For decoration rather than watching: `<inline-clip>` autoplays, muted, in a
    loop, with no controls. It is a single `<video>` element with its real size
    set, so nothing jumps while it loads, and it pauses while off-screen.

    ```html
    <inline-clip src="media/life-loop.mp4">
    ```
    </markdown>

    <inline-clip src="media/life-loop.mp4">
</div>
