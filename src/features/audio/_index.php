<?php
/**
 * @title      Audio
 * @section    features
 * @type       feature
 * @breadcrumb true
 * @position   6
 * @kicker     Plugin
 * @abstract   A SoundCloud-style player with a waveform baked at build time from the audio file itself.
 */
?>

<div class="prose">
    <markdown>
    [`@kirigami/plugin-player`](https://www.npmjs.com/package/@kirigami/plugin-player)
    turns a bare tag into a player. At build time it decodes the audio file once
    (with `@kirigami/audiowaveform-wasm`, BBC's `audiowaveform` compiled to
    WebAssembly) and bakes the waveform, the duration, the ID3 tags and the
    embedded cover art into the page. The browser only gets a small script for
    playback — and downloads nothing until someone presses play.

    ### One track

    ```html
    <player src="media/01-slow-fold.mp3">
    ```
    </markdown>

    <player src="media/01-slow-fold.mp3">

    <markdown>
    Title, artist and cover come from the file's own ID3 tags. The cover is written
    to `assets/images/player/` and published through the same pipeline as
    `<img asset>`, so it comes out resized, in the project's image format. Click
    the waveform to jump, drag to scrub.

    ### From Markdown

    ```
    {% player media/02-crease.mp3 %}
    ```

    {% player media/02-crease.mp3 %}

    ### A playlist

    A plain `.m3u` file; the next track starts when one ends. The last track has
    no ID3 tags at all, so the title is tidied up from the file name (`03_unfolding.mp3`)
    and a placeholder stands in for the cover:

    ```html
    <playlist src="media/set.m3u">
    ```
    </markdown>

    <playlist src="media/set.m3u">

    <markdown>
    ### Cached at build time

    Decoding is done once per file. The result is cached in `src/_data/player/`
    (keyed by the file's content, so a fresh checkout hits it) and meant to be
    committed — like the `<extlink>` cache, a rebuild never repeats the work.
    </markdown>
</div>
