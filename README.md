p4.mightypants.biz
==================

Project 4 - jDoku

This is a simple sudoku site that includes basic user stats.  Logged in users will have their puzzle-solving times saved and statistics--best time and average time per difficulty level--shown in a dashboard. They can also save and resume their puzzles.  Users who are not logged in can still solve puzzles, but can't save or see any stats.

General actions
- select a difficulty and begin solving (defaults to 'easy' if no selection), or...
- sign up and log in
- view dashboard with user stats current saved puzzle attempts
- resume saved puzzle or start a new one from the dashboard
- 4 or 5 puzzles for each of the 4 difficulty settings; one is randomly selected on startup

Puzzle-solving features
- puzzle timer
- pause/resume timer; puzzle is hidden while timer is paused
- accepts keyboard input
- clear currently selected cell or all cells
- check answers as you progress, answers auto-checked when the last cell is filled

Notes to instructor
- check out the 'solution' column in the 'puzzles' table if you don't want to take the time to solve puzzles while testing




Future additions (if I get around to it)
- undo/redo functionality
- 'pencil' notes/markup: a common sudoku feature that allows users to enter possible candidates in a given cell before the correct answer is determined
- global stats: best, average times for all users per difficulty setting
- integrate a puzzle generator; set it up to run every time a user has played all puzzles of a given difficulty setting