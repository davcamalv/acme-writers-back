<?php

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapter = new Chapter(["title"=>"The riddle house", "text"=>
        "   The villagers of Little Hangleton continued to call it 'the Mansion of the Ryddle’ although the Ryddles had not lived in it for many years. Erected on a hill overlooking the village, it was blinded with planks Some windows, the roof was missing tiles and ivy spread freely across the facade. It had once been a beautiful mansion and, with difference, the most stately and largest building within a radius of several kilometers, but now it was abandoned and dilapidated, and no one lived in it. In Little Hangleton everyone agreed that the old mansion was sinister. Half a century earlier something strange and horrible had happened to him, something. what the villagers still liked to talk about when the topics gossip was exhausted.

    They had told the story so many times and had been told added so many things, no one was quite sure what the truth was. All versions, however, started at the same point: fifty years before, on the dawn of a sunny summer morning, when the Ryddle Mansion still retained its imposing appearance, the maid she had entered the room and found the three Ryddle dead.

    The woman had run down the street screaming and screaming until she reached the village, awakening as many as he could. 'They are lying there with their eyes wide open!' They are cold as ice! And they still wear the dinner clothes! They called the police, and the whole village became abuzz with curiosity, fright and ill-concealed emotion. No one did the least effort to pretend that the death of the Riddles grieved him, because no one wanted to. Mr. and Mrs. Ryddle were rich, snobbish, and rude, though not as much as Tom, her grown son.

    Villagers wondered about the identity of the murderer, because it was evident that three people who enjoy, apparently, in good health they do not die the same night of death natural. The Hangman, which was what the village tavern was called, made his August that night, since everyone came to comment triple murder. For this they had left the heat of their homes, but they saw rewarded with the arrival of the Riddles' cook, who entered the tavern with a knock-on effect and announced to the crowd suddenly Silent, they had just arrested a man named Frank Bryce. 'Frank!' Some shouted. Can not be! Frank Bryce was the Riddles' outfielder and lived alone in a humble little house on the estate of their masters. He had returned from the war with his leg stiff and a clear aversion to crowds and loud noises. Since Back then, he had worked for the Riddles. Several of those present rushed to order a drink for the cook, and everyone got ready to hear the details. 'I always thought he was a weird guy,' the woman explained to the locals, who listened expectantly, after draining the fourth glass of sherry. He was very sullen. I must have invited him a hundred times to a drink, but he didn't I liked dealing with people, no sir. 'Well,' said a villager at the bar, 'poor Frank He had a bad time in the war, and he likes tranquility.

    That's no reason to ... 'And who other than him had the key to the back door?' -the interrupted the cook, raising his voice. There has always been a duplicate of the key hanging in the gardener's house, that I remember! And last night nobody forced the door! There is no broken window! Frank just had to go up to the mansion while we all slept ... The villagers exchanged gloomy glances. 'I always thought there was something unpleasant about him, of course,' he said, growling, a man sitting at the bar. 'The war made him a weird guy, if you're interested in my opinion,' he added. the owner of the tavern. 'I told you I wouldn't like to have Frank as my enemy.' What did I tell you, Dot? Said a woman nervously from the corner. 'Horrifying character,' Dot agreed, shaking his head briskly. up and down-. I remember when I was a child ... The next morning, in Little Hangleton, no one could fit any He doubts that Frank Bryce had killed the Riddles. But in the neighboring town of Great Hangleton, in the dark and seedy police station, Frank stubbornly repeated, over and over, that he was innocent and that the only person he had seen near the mansion on the day of his death The Riddles had been a teenager, a light-skinned, dark-haired stranger.

    No one else in the village had seen such a boy, and the police had the conviction that they were Frank's inventions. So when things were getting worse for him, the forensic report and everything changed.", "number"=>1]);
        $book = Book::all()->skip(2)->first();
        $book->chapters()->save($chapter);
    }
}
