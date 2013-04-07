<?php
namespace MusicStation\SiteBundle\Service;

use Symfony\Component\Form\Form;

/**
 * Send emails from MusicStation
 */
class EmailSenderService
{
    private $mailer;
    private $twig;
    private $admin_email;

    public function __construct(\Swift_Mailer $mailer, $twig, $admin_email)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->admin_email = $admin_email;
    }

    /**
     * Send feedback email
     *
     * @param FeedbackType $form
     */
    public function sendFeedbackEmail(Form $form)
    {
        // get admin email address
        $adminEmail = $this->admin_email;

        // get form data
        $data = $form->getData();

        /**
         * send mail to the MusicStation administrator
         */
        $title = 'A feedback has been submitted!';

        $message = <<<EOF
{$data['name']} sent a comment:

{$data['message']}
EOF;

        $this->sendMail($data['email'], $adminEmail, $title, $message);

        /**
         * send answer mail to the user
         */
        $title = 'Thank you for your feedback!';

        $message = <<<EOF
Dear {$data['name']}, your comment has been received. We will provide an answer soon.

Original feedback:
{$data['message']}
EOF;

        $this->sendMail($adminEmail, $data['email'], $title, $message);
    }

    /**
     * Send a mail
     *
     * @param $sender
     * @param $message
     */
    public function sendMail($sender, $recipient, $title, $message)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('[MusicStation] Feedback')
            ->setFrom($sender)
            ->setTo($recipient)
            ->setBody(
                $this->twig->render(
                    'MusicStationSiteBundle:EmailSender:email.txt.twig',
                    array(
                        'title' => $title,
                        'body' => $message
                    )
                )
            )
            ->addPart(
                $this->twig->render('MusicStationSiteBundle:EmailSender:email.html.twig',
                    array(
                        'title' => $title,
                        'body' => $message
                    )
                ),
                'text/html'
            )
        ;

        return $this->mailer->send($message);
    }
}